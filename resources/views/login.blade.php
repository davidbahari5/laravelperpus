<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <section class="bg-blue-100 w-full h-screen">
  <div class="flex h-full items-center justify-center max-w-2xl mx-auto my-auto">
    <div class="bg-white shadow-md border border-gray-200 rounded-lg w-full max-w-sm p-4 sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
      @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible text-white" role="alert">
          {{ Session::get('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>
      @endif
      <form class="space-y-6" action="/authenticate" method="POST">
        {{ csrf_field() }}
        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
        <div>
          <label for="username" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Your username</label>
          <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="username" required="">
        </div>
        <div>
          <label for="password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Your password</label>
          <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
        </div>    
        <div>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
            Not registered? <a href="/register" class="text-blue-700 hover:underline dark:text-blue-500">Create
              account</a>
        </div>
        </div>    
        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>        
      </form>
    </div>	
  </div>
  </section>
</body>
</html>