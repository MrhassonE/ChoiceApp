<x-app-dash-layout>
    <div class="container-fluid">
        <div class="row">
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('about-update'))
            <div class="col-md-12">
                <a class="btn btn-primary my-1" href="{{route('About.editWord',$about->id)}}">تعديل</a>
            </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">
                                كلمة المدير
                            </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$about->manager_word_ar}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" dir="ltr">
                    <div class="header">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">
                                Manager Word
                            </h4>
                        </div>
                    </div>
                    <div class="card-body" >
                        <p>{{$about->manager_word}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('about-update'))
            <div class="col-md-12">
                <a class="btn btn-primary my-1" href="{{route('About.editVision',$about->id)}}">تعديل</a>
            </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title my-0">
                                رؤيتنا
                            </h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$about->vision_ar}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" dir="ltr">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title my-0">
                                Vision
                            </h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$about->vision}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('about-update'))
            <div class="col-md-12">
                <a class="btn btn-primary my-1" href="{{route('About.editMission',$about->id)}}">تعديل</a>
            </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title my-0">
                                 مهمتنا
                            </h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$about->mission_ar}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" dir="ltr">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title my-0">
                                Our Mission
                            </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$about->mission}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('about-update'))
            <div class="col-md-12">
                <a class="btn btn-primary my-1" href="{{route('About.editGoal',$about->id)}}">تعديل</a>
            </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title my-0">
                                اهدافنا
                            </h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$about->goal_ar}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" dir="ltr">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title my-0">
                                Our goals
                            </h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$about->goal}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('about-update'))
            <div class="col-md-12">
                <a class="btn btn-primary my-1" href="{{route('About.EditQAUnit')}}">تعديل</a>
            </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title my-0">
                                وحدة الجودة والاعتماد المؤسسي
                            </h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$QAUnit->title_ar}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dash-layout>
