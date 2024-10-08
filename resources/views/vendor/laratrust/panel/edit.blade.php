@extends('laratrust::panel.layout')

@section('title', $model ? "تعديل الدور" : "أضافة دور")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div>
            <form
                x-data="laratrustForm()"
                x-init="{!! $model ? '' : '$watch(\'displayName\', value => onChangeDisplayName(value))'!!}"
                method="POST"
                action="{{$model ? route("laratrust.{$type}s.update", $model->getKey()) : route("laratrust.{$type}s.store")}}"
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 p-8"
            >
                @csrf
                @if ($model)
                    @method('PUT')
                @endif
                <label class="block">
                    <span class="text-gray-700">الاسم</span>
                    <input
                        class="form-input mt-1 block w-full bg-gray-200 text-gray-600 @error('name') border-red-500 @enderror"
                        name="name"
                        placeholder="سيتم انشائه تلقائيا"
                        :value="name"
                        readonly
                        autocomplete="off"
                    >
                    @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message}} </div>
                    @enderror
                </label>

                <label class="block my-4">
                    <span class="text-gray-700">الاسم المعروض</span>
                    <input
                        class="form-input mt-1 block w-full"
                        name="display_name"
                        placeholder="تعديل الاسم"
                        x-model="displayName"
                        autocomplete="off"
                    >
                </label>

                <label class="block my-4">
                    <span class="text-gray-700">الوصف</span>
                    <textarea
                        class="form-textarea mt-1 block w-full"
                        rows="3"
                        name="description"
                        placeholder="وصف عن الدور"
                    >{{ $model->description ?? old('description') }}</textarea>
                </label>
                @if($type == 'role')
                    <span class="block text-gray-700">الأذونات</span>
                    <div class="flex flex-wrap justify-start mb-4">
                        @foreach ($permissions as $permission)
                            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                                <input
                                    type="checkbox"
                                    class="form-checkbox h-4 w-4"
                                    name="permissions[]"
                                    value="{{$permission->getKey()}}"
                                    {!! $permission->assigned ? 'checked' : '' !!}
                                >
                                <span class="mr-4"> {{__('permissions.'.$permission->name)}} </span>
                            </label>
                        @endforeach
                    </div>
                @endif
                <div class="flex justify-content-start">
                    <a
                        href="{{route("laratrust.{$type}s.index")}}"
                        class="btn btn-secondary mx-2"
                    >
                        الغاء
                    </a>
                    <button class="btn btn-primary" type="submit">حفظ</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        window.laratrustForm =  function() {
            return {
                displayName: '{{ $model->display_name ?? old('display_name') }}',
                name: '{{ $model->name ?? old('name') }}',
                toKebabCase(str) {
                    return str &&
                        str
                            .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                            .map(x => x.toLowerCase())
                            .join('-')
                            .trim();
                },
                onChangeDisplayName(value) {
                    this.name = this.toKebabCase(value);
                }
            }
        }
    </script>
@endsection
