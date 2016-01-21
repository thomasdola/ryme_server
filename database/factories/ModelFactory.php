<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Ad;
use App\Category;
use App\Company;
use App\Event;
use App\Track;
use App\User;
use App\Vouch;
use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $fake) {
    return [
        'uuid' => $fake->uuid,
        'name' => $fake->name,
        'phone' => $fake->phoneNumber,
        'country' => $fake->country,
        'stage_name' => $fake->userName,
        'username' => $fake->userName,
        'type' => 'user',
        'category_id' => collect(Category::all()->lists('id'))->random(),
        'email' => $fake->email,
        'is_artist' => $fake->boolean(10),
        'artist_on' => Carbon::now(),
        'is_request_active' => $fake->boolean(10),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Track::class, function (Faker\Generator $fake) {
    return [
        'uuid' => $fake->uuid,
        'title' => $fake->sentence(2),
        'user_id' => collect(User::where('is_artist', true)->lists('id'))->random(),
        'released_date' => Carbon::parse($fake->date()),
        'category_id' => collect(Category::all()->lists('id'))->random()
    ];
});

$factory->define(App\Category::class, function(Faker\Generator $fake){
    return [
        'name' => $fake->sentence(2),
        'uuid' => $fake->uuid
    ];
});

$factory->define(App\Ad::class, function(Faker\Generator $fake){
    return [
        'uuid' => $fake->uuid,
        'title' => $fake->sentence(2),
        'start_date' => Carbon::now(),
        'end_date' => Carbon::now()->addDays(7),
        'is_active' => $fake->boolean(80),
        'company_id' => collect(Company::all()->lists('id'))->random()
    ];
});

$factory->define(App\Company::class, function(Faker\Generator $fake){
    return [
        'name'=>$fake->company,
        'uuid'=>$fake->uuid
    ];
});

$factory->define(App\Download::class, function(Faker\Generator $fake){
    return [
        'user_id'=>collect(User::all()->lists('id'))->random(),
        'track_id'=>collect(Track::all()->lists('id'))->random()
    ];
});

$factory->define(App\Favorite::class, function(Faker\Generator $fake){
    return [
        'user_id'=>collect(User::all()->lists('id'))->random(),
        'track_id'=>collect(Track::all()->lists('id'))->random()
    ];
});

$factory->define(App\Vouch::class, function(Faker\Generator $fake){
    return [
        'user_id'=>collect(User::where('is_request_active', true)->lists('id'))->random(),
        'is_active'=> true,
        'start_date'=>Carbon::now()->startOfDay(),
        'end_date'=>Carbon::now()->startOfDay()->addDays(14),
    ];
});

$factory->define(App\VouchResponse::class, function(Faker\Generator $fake){
    return [
        'user_id'=>collect(User::all()->lists('id'))->random(),
        'vouch_id'=>collect(Vouch::where('is_active', true)->lists('id'))->random(),
        'answer'=>$fake->boolean(90)
    ];
});

$factory->define(App\Comment::class, function(Faker\Generator $fake){
    return [
        'user_id'=>collect(User::all()->lists('id'))->random(),
        'track_id'=>collect(Track::all()->lists('id'))->random(),
        'body'=>$fake->sentence
    ];
});

$factory->define(App\Stream::class, function(Faker\Generator $fake){
    return [
        'user_id'=>collect(User::all()->lists('id'))->random(),
        'streamable_id'=>collect(Track::all()->lists('id'))->merge(Ad::all()->lists('id'))->random(),
        'streamable_type'=>collect(['App\Track', 'App\Ad'])->random(),
    ];
});

$factory->define(App\Following::class, function(Faker\Generator $fake){
    return [
        'user_id'=>collect(User::where('is_artist', true)->lists('id'))->random(),
        'followable_id'=>collect(Category::all()->lists('id'))
            ->merge(User::where('is_artist', true)->lists('id'))->random(),
        'followable_type'=>collect(['App\Category', 'App\User'])->random(),
    ];
});

$factory->define(App\Photo::class, function(Faker\Generator $fake){
    return [
        'type'=>collect(['avatar', 'stage'])->random(),
        'uuid'=>$fake->uuid,
        'path'=>$fake->imageUrl(),
        'imageable_id'=>collect(User::all()->lists('id'))
            ->merge(Event::all()->lists('id'))
            ->merge(Track::all()->lists('id'))->random(),
        'imageable_type'=>collect(['App\Track', 'App\User', 'App\Event'])->random(),
    ];
});

$factory->define(App\NotificationChannel::class, function(Faker\Generator $fake){
    return [
        'name'=>$fake->word,
        'uuid'=>$fake->uuid,
        'channelable_id'=>collect(Category::all()->lists('id'))
            ->merge(User::where('is_artist', true)->lists('id'))->random(),
        'channelable_type'=>collect(['App\Category', 'App\User', 'App\Track'])->random(),
    ];
});

$factory->define(App\File::class, function(Faker\Generator $fake){
    return [
        'path'=>'aws.s3.amazon.com/'.$fake->word.$fake->uuid.'mp3',
        'uuid'=>$fake->uuid,
        'filable_id'=>collect(Track::all()->lists('id'))->random(),
        'filable_type'=>'App\Track',
    ];
});

$factory->define(App\View::class, function(Faker\Generator $fake){
    return [
        'user_id'=>collect(User::all()->lists('id'))->random(),
        'viewable_id'=>collect(Event::all()->lists('id'))
            ->merge(Track::all()->lists('id'))->random(),
        'viewable_type'=>collect(['App\Track', 'App\Event'])->random(),
    ];
});

$factory->define(App\Event::class, function(Faker\Generator $fake){
    return [
        'title'=>$fake->title,
        'uuid'=>$fake->uuid,
        'description'=>$fake->text,
        'time'=>$fake->time(),
        'date'=>Carbon::now()->addDays(2),
        'start_date'=>Carbon::now(),
        'end_date'=>Carbon::now()->addDays(2)->startOfDay(),
        'is_active'=>$fake->boolean(80)
    ];
});