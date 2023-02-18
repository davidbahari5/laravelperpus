<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
</head>
<body>  
  <div class="relative h-screen">
    <!-- navbar goes here -->
    <nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
      <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
              <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                  <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
              </button>
              <a href="/katalog" class="text-xl font-bold flex items-center lg:ml-2.5">
                <img src="{{url('/images/tugas-logo.svg')}}" class="h-6 mr-2" alt="Windster Logo">
                <span class="self-center whitespace-nowrap">Perpus.co</span>
              </a>                
            </div>
            <div class="flex items-center">
              <a href="/history" class="hidden sm:flex ml-5 text-cyan-600 bg-white border border-solid border-x-cyan-600 hover:bg-cyan-600 hover:text-white focus:ring-4 focus:ring-cyan-200 font-medium r6unded-lg text-sm px-5 py-2.5 text-center items-center mr-3">                    
                History Pemesanan
              </a>
              <a href="/logout" class="hidden sm:flex ml-5 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-3">                    
                Logout
              </a>
            </div>
        </div>
      </div>
    </nav>
    <div class="flex overflow-hidden bg-gray-50 pt-16">
      <div class="grid grid-cols-1 xl:gap-4 my-4 pt-8 mx-auto">                    
        <div class="flex flex-col gap-6 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
          <div class="flex justify-between items-center">
            <h3 class="text-xl leading-none font-bold text-gray-900">History Pemesanan</h3>            
          </div>
          <div class="block w-full overflow-x-auto">
              <table id="user-table" class="items-center w-full bg-transparent border-collapse">
                <thead>
                    <tr>
                      <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Judul Buku</th>
                      <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Tanggal Pesan</th>                      
                      <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Status</th>                      
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                  @foreach($data as $d)
                    <tr class="text-gray-500">
                      <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->Buku->judul }}</th>
                      <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ Carbon\Carbon::parse($d->tanggal)->format('d M Y') }}</th>                      
                      <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->status == 0 ? 'Menunggu' : 'Disetujui' }}</th>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>                
      </div>
    </div>    
  </div>
  
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {  
      // Modal

      let modal = document.getElementById("modal");
      $(".closeModal").on("click", function () {
        modalHandler();
      })
      $("#openModal").on("click", function () {
        modalHandler(true);
      })
      function modalHandler(val) {
          if (val) {
              fadeIn(modal);
          } else {
              fadeOut(modal);
          }
      }
      function fadeOut(el) {
          el.style.opacity = 1;
          (function fade() {
              if ((el.style.opacity -= 0.1) < 0) {
                  el.style.display = "none";
              } else {
                  requestAnimationFrame(fade);
              }
          })();
      }
      function fadeIn(el, display) {
          el.style.opacity = 0;
          el.style.display = display || "flex";
          (function fade() {
              let val = parseFloat(el.style.opacity);
              if (!((val += 0.2) > 1)) {
                  el.style.opacity = val;
                  requestAnimationFrame(fade);
              }
          })();
      }
    });
  </script>
  
</body>
</html>