@extends('layout/index')

@section('title', 'Dashboard')

  @section('content')
    <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
      <div id="main-chart" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
        <main>
            <div class="pt-6 px-4">                
              <div class="grid grid-cols-1 xl:gap-4 my-4">                    
                  <div class="flex flex-col gap-6 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex justify-between items-center">
                      <h3 class="text-xl leading-none font-bold text-gray-900">Daftar Buku</h3>
                      <button id="openModalTambah" class="ml-5 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-3">Tambah Buku</button>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table id="user-table" class="items-center w-full bg-transparent border-collapse">
                          <thead>
                              <tr>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Judul Buku</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Pengarang</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Penerbit</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Keterangan</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Stock</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Status</th>                                
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Gambar</th>                                
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px">Action</th>
                              </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-100">
                            @foreach($data as $d)
                              <tr class="text-gray-500">
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->judul }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->Pengarang->nama }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->Penerbit->nama }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->keterangan }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->stock }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">                                
                                  @if($d->status == 0) Available
                                  @elseif($d->status == 1) Rented
                                  @elseif($d->status == 2) Broken
                                  @endif
                                </th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                                  <img src="{{ $d->gambar }}" alt="Product Image" class="max-w-[64px] object-cover object-center">
                                </th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                                  <div class="flex gap-2">
                                    <a href="#!" id="openModalEdit" data-id_buku="{{ $d->id_buku }}" data-judul="{{ $d->judul }}" data-pengarang="{{ $d->Pengarang->id_pengarang }}" 
                                    data-penerbit="{{ $d->Penerbit->id_penerbit }}" data-keterangan="{{ $d->keterangan }}" data-stock="{{ $d->stock }}" 
                                    data-status="{{ $d->status }}" class="text-green-500 edit-button">Edit</a> |                                       
                                    <a href="/hapus-buku/{{ $d->id_buku }}" class="text-red-400">Delete</a>
                                  </div>
                                </th>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  </div>
              </div>
            </div>
        </main>          
      </div>
  </div>    

  <!-- Modal Tambah-->
  <div class="hidden py-12 bg-gray-700 bg-opacity-75 transition duration-150 ease-in-out absolute top-0 right-0 bottom-0 left-0 z-50" id="modal-tambah">
      <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
          <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">    
          <form id="my-form" action="/tambah-buku" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
              <input id="id_buku" name="id_buku" type="hidden" />            
              <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Input Buku</h1>
              <label for="judul" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Judul Buku</label>
              <input id="judul" name="judul" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan judul" required/>

              <label for="pengarang" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Pilih Pengarang</label>
              <select id="pengarang" name="pengarang" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" required>
                @foreach($pengarang as $p)
                  <option value="{{ $p->id_pengarang }}">{{ $p->nama }}</option>
                @endforeach
              </select>

              <label for="penerbit" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Pilih Penerbit</label>
              <select id="penerbit" name="penerbit" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" required>
                @foreach($penerbit as $t)
                  <option value="{{ $t->id_penerbit }}">{{ $t->nama }}</option>
                @endforeach
              </select>

              <label for="keterangan" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Keterangan</label>
              <input id="keterangan" name="keterangan" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Keterangan Buku" required/>

              <label for="stock" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Stock</label>
              <input id="stock" type="number" name="stock" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Jumlah Buku" required/>

              <label for="status" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Pilih Status Buku</label>
              <select id="status" name="status" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" required>                
                <option value="0" selected="selected">Available</option>
                <option value="1">Rented</option>
                <option value="2">Broken</option>                
              </select>

              <label for="gambar" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Preview Buku</label>              
              <input id="gambar" name="gambar" type="file" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Foto Buku" required/>
              
              <div class="flex items-center justify-start w-full">
                  <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                  <button type="button" class="closeModal focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalHandlerTambah()">Cancel</button>
              </div>
            </form>

              <button class="closeModal cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" onclick="modalHandlerTambah()" aria-label="close modal" role="button">
                  <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <line x1="18" y1="6" x2="6" y2="18" />
                      <line x1="6" y1="6" x2="18" y2="18" />
                  </svg>
              </button>
          </div>
      </div>
  </div>
  <!-- Modal Edit -->
  <div class="hidden py-12 bg-gray-700 bg-opacity-75 transition duration-150 ease-in-out absolute top-0 right-0 bottom-0 left-0 z-50" id="modal-edit">
      <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
          <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">    
          <form id="my-form" action="/edit-buku" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
              <input id="edit-id_buku" name="id_buku" type="hidden" />            
              <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Input Buku</h1>
              <label for="judul" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Judul Buku</label>
              <input id="edit-judul" name="judul" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan judul" required/>

              <label for="pengarang" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Pilih Pengarang</label>
              <select id="edit-pengarang" name="pengarang" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" required>
                @foreach($pengarang as $p)
                  <option value="{{ $p->id_pengarang }}">{{ $p->nama }}</option>
                @endforeach
              </select>

              <label for="penerbit" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Pilih Penerbit</label>
              <select id="edit-penerbit" name="penerbit" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" required>
                @foreach($penerbit as $t)
                  <option value="{{ $t->id_penerbit }}">{{ $t->nama }}</option>
                @endforeach
              </select>

              <label for="keterangan" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Keterangan</label>
              <input id="edit-keterangan" name="keterangan" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Keterangan Buku" required/>

              <label for="stock" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Stock</label>
              <input id="edit-stock" type="number" name="stock" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Jumlah Buku" required/>

              <label for="status" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Pilih Status Buku</label>
              <select id="edit-status" name="status" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" required>                
                <option value="0" selected="selected">Available</option>
                <option value="1">Rented</option>
                <option value="2">Broken</option>                
              </select>

              <label for="gambar" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Preview Buku</label>              
              <input id="edit-gambar" name="gambar" type="file" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Foto Buku"/>
              
              <div class="flex items-center justify-start w-full">
                  <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                  <button type="button" class="closeModal focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalHandlerEdit()">Cancel</button>
              </div>
            </form>

              <button class="closeModal cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" onclick="modalHandlerEdit()" aria-label="close modal" role="button">
                  <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <line x1="18" y1="6" x2="6" y2="18" />
                      <line x1="6" y1="6" x2="18" y2="18" />
                  </svg>
              </button>
          </div>
      </div>
  </div>
  @endsection
  
  @section('script') 
  <script type="text/javascript">
    $(document).ready(function () {  
      // Modal

      let modalTambah = document.getElementById("modal-tambah");
      let modalEdit = document.getElementById("modal-edit");
      function modalHandlerTambah(val) {
        if (val) {
            fadeIn(modalTambah);
        } else {
            fadeOut(modalTambah);
        }
    }
    function modalHandlerEdit(val) {
        if (val) {
            fadeIn(modalEdit);
        } else {
            fadeOut(modalEdit);
        }
    }
      $(".closeModal").on("click", function () {
        modalHandlerTambah();
        modalHandlerEdit();
      })
      $("#openModalTambah").on("click", function () {
        modalHandlerTambah(true);
      })
      $("#openModalEdit").click((e) => {
        $(':input.text-gray-600').val("");
        $('#edit-judul').val(e.currentTarget.dataset.judul);
        $('#edit-pengarang').val(e.currentTarget.dataset.pengarang);
        $('#edit-penerbit').val(e.currentTarget.dataset.penerbit);
        $('#edit-keterangan').val(e.currentTarget.dataset.keterangan);
        $('#edit-stock').val(e.currentTarget.dataset.stock);
        $('#edit-status').val(e.currentTarget.dataset.status);
        $('#edit-id_buku').val(e.currentTarget.dataset.id_buku);
        modalHandlerEdit(true);
      })                  
    });        

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
  </script>
  @endsection
  