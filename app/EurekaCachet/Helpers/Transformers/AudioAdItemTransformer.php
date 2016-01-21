<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/19/2016
 * Time: 4:25 PM
 */

namespace Eureka\Helpers\Transformers;


use App\Ad;
use App\Company;
use App\File;
use League\Fractal\TransformerAbstract;

class AudioAdItemTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['company', 'file'];

    public function transform(Ad $ad)
    {
        return [
            'id'=>$ad->uuid,
            'title'=>$ad->title,
            'startDate'=>$ad->start_date,
            'endDate'=>$ad->end_date,
            'totalStreams'=>(int) $ad->streams->count()
        ];
    }

    public function includeCompany(Ad $ad)
    {
        $company = $ad->company;
        return $this->item($company, function(Company $company){
            return [
                'name'=>$company->name
            ];
        });
    }

    public function includeFile(Ad $ad)
    {
        $file = $ad->files->first();
        return $this->item($file, function(File $file){
            return [
                'path' => $file->path
            ];
        });
    }
}