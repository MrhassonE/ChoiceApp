<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\WhatsNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class WhatsNewController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:whats-new-read')->only('index');
        $this->middleware('permission:whats-new-create')->only('store');
        $this->middleware('permission:whats-new-update')->only('edit','update');
        $this->middleware('permission:whats-new-delete')->only('destroy');
    }

    public function index(){
        $news = WhatsNew::orderByDesc('created_at')->get();
        return view('Dashboard.WhatsNew.index',compact('news'));
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:100',
        ]);
        $news = WhatsNew::create([
            'id'=>rand(100000,999999),
            'title'=>$request->title
        ]);

        $text = 'تم اضافة خبر جديد بأسم '.$news->title;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function edit(WhatsNew $new){
        return view('Dashboard.WhatsNew.Edit',compact('new'));
    }

    public function update(Request $request, WhatsNew $new){
        $request->validate([
            'title'=>'required|max:100',
        ]);
        $new->update($request->all());
        $text = 'تم تعديل الخبر '.$new->title;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function destroy(WhatsNew $new){
        $text = 'تم حذف الخبر '.$new->title;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $new->delete();
    }
}
