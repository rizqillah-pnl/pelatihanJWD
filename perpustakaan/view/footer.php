 <!-- Modal Logout -->
 <div class="modal fade " id="Logout" tabindex="-1" aria-labelledby="LogoutLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="LogoutLabel">Logout</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 Anda yakin ingin mengakhiri session?
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
                 <a href="../logout.php" class="btn btn-danger text-white">Keluar</a>
             </div>
         </div>
     </div>
 </div>

 <script>
     function validateImg(input, nameButton, IDfoto, IDpreview, IDfeedback) {
         const image = input.files[0].type.indexOf("image");
         const fileSize = input.files[0].size;

         let foto = document.getElementById(IDfoto);
         let submit = document.getElementById(nameButton);
         let pesan = document.getElementById(IDfeedback);

         if (image == 0) {
             let cek = document.getElementById("preview");
             if (cek) {
                 cek.remove();
             }

             if (fileSize > 2080000) {
                 foto.classList.add('is-invalid');
                 submit.disabled = true;
                 pesan.innerHTML = "Size gambar harus dibawah 2 MB";
             } else {
                 let induk = null;
                 induk = document.getElementById(IDpreview);
                 let preview = document.createElement('img');
                 preview.width = "100";
                 preview.height = "100";
                 preview.classList.add('mt-3');
                 preview.id = "preview";

                 //  let preview = document.getElementById('preview');
                 preview.src = URL.createObjectURL(event.target.files[0]);
                 induk.appendChild(preview);

                 preview.onload = function() {
                     URL.revokeObjectURL(preview.src) // free memory
                 }
                 foto.classList.remove('is-invalid');
                 submit.disabled = false;
             }
         } else {
             foto.classList.add('is-invalid');
             pesan.innerHTML = 'Inputan bukan gambar!';
             submit.disabled = true;
         }
     }

     function toNumber(evt) {
         // Only ASCII character in that range allowed
         var ASCIICode = (evt.which) ? evt.which : evt.keyCode
         if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
             return false;
         return true;
     }

     function changePic(buku) {
         let bookID = buku.value;
         let picBook = document.getElementById('picBook');

         $.get("ajax-view/getPicBook.php?search=" + bookID, function(data) {
             picBook.src = "../public/img/buku/" + data;
         })
     }

     function profilChange(prof) {
         let id = prof.value;
         let picUser = document.getElementById('picUser');

         $.get("ajax-view/getPicUser.php?search=" + id, function(data) {
             picUser.src = "../public/img/anggota/" + data;
         })
     }
 </script>


 <!-- CoreUI and necessary plugins-->
 <script src="../vendor/coreUI/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
 <script src="../vendor/coreUI/vendors/simplebar/js/simplebar.min.js"></script>
 <script src="../vendor/coreUI/vendors/@coreui/utils/js/coreui-utils.js"></script>