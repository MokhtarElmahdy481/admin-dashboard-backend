<a 
href="{{route("clientProfile",Auth::user()->id)}}" 
class="flex items-center">
    <img src="{{asset("storage/uploads/logo.jpg")}}" class="h-12 mr-3" alt="Flowbite Logo" />
    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{trans("messages.app_logo")}}</span>
</a>