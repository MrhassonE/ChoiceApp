<x-app-dash-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary my-1" href="{{route('About.edit-who-we-are',$about->id)}}">تعديل</a>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">
                                من نحن
                            </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$about->title}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dash-layout>
