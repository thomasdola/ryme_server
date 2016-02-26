<?php

namespace App\Jobs;

use App\Events\UserCreated;
use DB;
use Eureka\Repositories\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Mockery\Exception;
use Webpatser\Uuid\Uuid;

class RegisterUser extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var Collection
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param Collection $data
     */
    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param UserRepository $userRepository
     * @return array|null
     */
    public function handle(UserRepository $userRepository)
    {
        $payload = $this->data->only('dial_code', 'phone_number', 'username', 'password');
        $phone = $this->setPhoneNumber($this->data);
        $data = $this->prepareData($payload, $phone);
        DB::beginTransaction();
        try{
            $user = $userRepository->add($data);
        }catch (Exception $e){
            throw $e;
        }
        $verification_code = $this->generateOTP();
        $user->verification_code()->create([
            'code'=>$verification_code
        ]);
        try{
            event(new UserCreated($user));
        }catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }

    private function setPhoneNumber(Collection $payload)
    {
        $dial_code = $payload->get('dial_code');
        $raw_phone = $payload->get('phone_number');
        $phone = $dial_code . $raw_phone;
        return $phone;
    }

    private function generateOTP()
    {
        return mt_rand(1000, 9999);
    }

    private function prepareData($payload, $phone)
    {
        $payload = collect($payload)->except('dial_code', 'phone_number');
        $password = bcrypt($payload->get('password'));
        $uuid = Uuid::generate(4);
        $data = array_add(array_add($payload->except('password')->all(), 'uuid', $uuid), 'type', 'user');
        $data = array_add($data, 'phone', $phone);
        return array_add($data, 'password', $password);
    }
}
