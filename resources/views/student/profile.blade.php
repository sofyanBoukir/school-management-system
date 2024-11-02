<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900">

    <x-side-bar fullName='{{$student->full_name}}' profilePhoto='{{$student->image}}'>
      <h1 class="text-white mt-5 text-3xl font-semibold">Hello, {{$student->full_name}}</h1>
      <h1 class="text-white mt-1 font-semibold text-sm">Here is your personal informations</h1>
      @if (session("success"))
          <x-alert>
            {{session("success")}}
          </x-alert>
      @endif
      <form class="text-white mt-6" method="POST" action="{{route("student.profile.update",$student->id)}}" enctype="multipart/form-data">
        @csrf
        @method("PUT")     
        <labe class="mb-1">Profile photo</label>
        <div class="flex gap-1 items-center">
          <div class="">
            <img src="{{asset($student->image)}}" class="rounded-full w-11 h-11"/>
          </div>
          <div class="">
            <label for="file-upload" class="bg-blue-500 rounded-sm px-2 py-1 cursor-pointer hover:bg-blue-400">Change photo</label>
            <input type="file" id="file-upload" class="hidden" name="image"/>
            <span>PNG,GPG,GPEG max:10mb</span>
          </div>
        </div>
        <span class="text-sm text-red-500">
          @error('image')
            {{$message}}
          @enderror
        </span>

       <div class="flex justify-between gap-10 mt-4">
          <div>
            <label class="">Full name</label>
            <input type="text" 
                name="full_name" 
                class="w-[100%] rounded-lg py-2 px-3 borde-none outline-blue-700 mt-1 border-gray-500 dark:bg-gray-700"
                value="{{$student->full_name}}"/>
          </div>
          <div>
            <label class="w-[30%]">Username</label>
            <input type="text" 
                name="username" 
                class="w-[100%] rounded-lg py-2 px-3 borde-none outline-blue-700 mt-1 border-gray-500 dark:bg-gray-700"
                value="{{$student->username}}"/>
          </div>
          <div>
            <label class="w-[30%]">Gender</label>
            <input type="text" 
                name="gender" 
                class="w-[100%] rounded-lg py-2 px-3 borde-none outline-blue-700 mt-1 border-gray-500 dark:bg-gray-700"
                value="{{$student->gender}}"/>
          </div>
       </div>
        <div class="mt-4">
          <label>Email</label>
          <input type="email" 
          name="email" 
          class="w-[100%] rounded-lg py-2 px-3 borde-none outline-blue-700 mt-1 border-gray-500 dark:bg-gray-700"
          value="{{$student->email}}"/>
        </div>
        <div class="mt-4">
          <label>Adress</label>
          <input type="text" 
          name="adress" 
          class="w-[100%] rounded-lg py-2 px-3 borde-none outline-blue-700 mt-1 border-gray-500 dark:bg-gray-700"
          value="{{$student->adress}}"/>
        </div>
        <div class="flex gap-10 mt-4">
          <div>
            <label class="">Birthday date</label>
            <input type="date" 
                name="birth_date" 
                class="w-[100%] rounded-lg py-2 px-3 borde-none outline-blue-700 mt-1 border-gray-500 dark:bg-gray-700"
                value="{{$student->birth_date}}"/>
          </div>
          <div>
            <label class="w-[30%]">Current grade</label>
            <input type="text" 
                name="current_grade" 
                class="w-[100%] rounded-lg py-2 px-3 borde-none outline-blue-700 mt-1 border-gray-500 dark:bg-gray-700"
                value="{{$student->current_grade}}" readonly/>
          </div>
          <div>
            <label class="w-[30%]">Parent's phone number</label>
            <input type="text" 
                name="parent_phone" 
                class="w-[100%] rounded-lg py-2 px-3 borde-none outline-blue-700 mt-1 border-gray-500 dark:bg-gray-700"
                value="{{$student->parent_phone}}" readonly/>
          </div>
        </div>
        
        <div class="flex gap-10 mt-4">
          <div>
            <label class="">Parent's full name</label>
            <input type="text" 
                name="parent_name" 
                class="w-[100%] rounded-lg py-2 px-3 borde-none outline-blue-700 mt-1 border-gray-500 dark:bg-gray-700"
                value="{{$student->parent_name}}"/>
          </div>
        </div>
        <div class="flex justify-end gap-2">
          <input type="reset" 
          class="dark:bg-gray-900 px-4 cursor-pointer py-1.5 border border-gray-500 text-white rounded-lg"
          value="Cancel"/>
          <input type="submit" 
          class="bg-green-700 px-4 py-1.5 text-white rounded-lg cursor-pointer hover:bg-green-600"
          value="Save changes"/>
        </div>
      </form>
    </x-side-bar>
</body>
</html>
