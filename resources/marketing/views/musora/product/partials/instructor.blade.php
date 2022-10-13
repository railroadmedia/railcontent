<div class="mb-4 mt-10">
    <div>
        <p class="font-bold text-lg uppercase mb-6 md:text-xl lg:text-2xl">About the Instructor </p>
    </div>
    <div>
        <img class="mb-5 rounded-md w-full" src="@if(str_contains($instructorPhoto, 'amazonaws') || str_contains($instructorPhoto, 'cloudfront')){{$instructorPhoto}}@else{{'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$instructorPhoto}}@endif">
        <p>{!!  nl2br($instructorBio) !!}</p>
    </div>
</div>
