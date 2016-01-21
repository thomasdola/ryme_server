<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/8/2016
 * Time: 8:16 PM
 */

namespace Eureka\Repositories;


use App\User;
use Carbon\Carbon;

class UserRepository
{

    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getAllUsersCount()
    {
       return $this->getAllUsers()->count();
    }

    public function getAllUsers()
    {
        return $this->user->all();
    }

    public function getUsersJoinedTodayCount()
    {
        return $this->getUsersJoinedToday()->count();
    }

    public function getUsersJoinedToday()
    {
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        return $this->getRecentJoinedUsers($startDate, $endDate);
    }

    private function getRecentJoinedUsers($startDate, $endDate)
    {
        return $this->user->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getUsersJoinedThisWeekCount()
    {
        return $this->getUsersJoinedThisWeek()->count();
    }

    public function getUsersJoinedThisWeek()
    {
        $startDate = Carbon::now()->subWeek()->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        return $this->getRecentJoinedUsers($startDate, $endDate);
    }

    public function getUsersJoinedThisMonthCount()
    {
       return $this->getUsersJoinedThisMonth()->count();
    }

    public function getUsersJoinedThisMonth()
    {
        $startDate = Carbon::now()->subMonth()->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        return $this->getRecentJoinedUsers($startDate, $endDate);
    }

    public function deleteUserById($id)
    {
        $deletedUser = $this->user->find($id);
        $deletedUser->delete();
        return $deletedUser;
    }
}