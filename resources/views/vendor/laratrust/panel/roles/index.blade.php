@extends('laratrust::panel.layout')

@section('title', 'الأدوار')

@section('content')
    <div class="flex flex-col">
        <a
            href="{{route('laratrust.roles.create')}}"
            class="self-end bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
        >
            + أضافة دور
        </a>
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                    <tr>
                        <th class="th text-right"></th>
                        <th class="th text-right">الاسم المعروض</th>
                        <th class="th text-right">الاسم</th>
                        <th class="th text-right"># الأذونات</th>
                        <th class="th text-right"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach ($roles as $key=>$role)
                        @if($role->id != 1)
                            <tr>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{$key+1}}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{$role->display_name}}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{$role->name}}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{$role->permissions_count}}
                                </td>
                                <td class="flex justify-end px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    @if (\Laratrust\Helper::roleIsEditable($role))
                                        <button type="button" class="btn btn-primary btn-round">
                                            <a href="{{route('laratrust.roles.edit', $role->getKey())}}" class="text-light text-blue-600 hover:text-blue-900"><i class="fa fa-pen me-1"></i>تعديل</a>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary btn-round">
                                            <a href="{{route('laratrust.roles.show', $role->getKey())}}" class="text-light text-blue-600 hover:text-blue-900"><i class="fa fa-pen me-1"></i>التفاصيل</a>
                                        </button>
                                    @endif
                                    <form
                                        action="{{route('laratrust.roles.destroy', $role->getKey())}}"
                                        method="POST"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد حذف الدور؟');"
                                    >
                                        @method('DELETE')
                                        @csrf

                                        <button
                                            type="submit"
                                            class="{{\Laratrust\Helper::roleIsDeletable($role) ? 'btn btn-primary btn-round text-red-600 hover:text-red-900' : 'text-gray-600 hover:text-gray-700 cursor-not-allowed'}} ml-4"
                                            @if(!\Laratrust\Helper::roleIsDeletable($role)) disabled @endif
                                        >حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $roles->links('laratrust::panel.pagination') }}
@endsection
