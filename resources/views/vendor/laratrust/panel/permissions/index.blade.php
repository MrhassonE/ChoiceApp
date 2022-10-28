@extends('laratrust::panel.layout')

@section('title', 'الأذونات')

@section('content')
    <div class="flex flex-col">
        @if (config('laratrust.panel.create_permissions'))
            {{--    <a--}}
            {{--      href="{{route('laratrust.permissions.create')}}"--}}
            {{--      class="self-end bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"--}}
            {{--    >--}}
            {{--      + أضافة صلاحية--}}
            {{--    </a>--}}
        @endif
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                    <tr>
                        <th class="th text-right"></th>
                        <th class="th text-right">الاسم</th>
                        <th class="th text-right">الوصف</th>
                        {{--                <th class="th text-right">الوصف</th>--}}
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach ($permissions as $permission)
                        <tr>
                            <td class="td text-sm leading-5 text-gray-900">
                                {{$permission->getKey()}}
                            </td>
                            <td class="td text-sm leading-5 text-gray-900">
                                {{$permission->name}}
                            </td>
                            <td class="td text-sm leading-5 text-gray-900">
                                {{__('permissions.'.$permission->name)}}
                            </td>
                            {{--              <td class="td text-sm leading-5 text-gray-900">--}}
                            {{--                {{$permission->description}}--}}
                            {{--              </td>--}}
                            {{--              <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">--}}
                            {{--                <a href="{{route('laratrust.permissions.edit', $permission->getKey())}}" class="text-blue-600 hover:text-blue-900">Edit</a>--}}
                            {{--              </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $permissions->links('laratrust::panel.pagination') }}
@endsection
