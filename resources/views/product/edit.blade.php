<html>
    <body>
        <h4> welcome</h4>
        <form action="{{ $route }}" method="post">
        <!-- href="{{ action('Admin\AcademicYearController@create') }}"-->
        @csrf
        
            <input type="hidden" name="_method" value="PUT">
        
         <label>Name</label>
         <input type="text" value="{{$user->name}}">

         <label>Email</label>
         <input type="text" value="{{$user->email}}">

         <button>Save</button>
        </form>
    </body>
</html>