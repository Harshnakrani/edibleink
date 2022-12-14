 <!-- Harshil Trivedi (8804546)
Shiv Ahir (8809928)
Harsh Nakrani (8812036) -->


 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
     <!-- Control sidebar content goes here -->
     <div class="p-3">
         <h5>Change Font</h5>
         <select class="form-control mb-3" id="sl_change_font" size="5">
             <option>xx-small</option>
             <option>x-small</option>
             <option>small</option>
             <option>medium</option>
             <option>large</option>
             <option>x-large</option>
             <option>xx-large</option>
             <option>100%</option>
             <option>250%</option>
             <option>2cm</option>
             <option>100px</option>
         </select>
         <div>
             <button class="btn btn-primary" onclick="change_it()">Change</button>
             <button class="btn btn-default" onclick="location.reload();">reset</button>

         </div>

     </div>
 </aside>
 <!-- /.control-sidebar -->

 <!-- Main Footer -->
 <footer class="main-footer">
     <!-- To the right -->
     <div class="float-right d-none d-sm-inline">
         <?php echo  APP_NAME ?>
     </div>
     <!-- Default to the left -->
     <strong>Copyright &copy; 2022.</strong> All rights reserved <strong> @<?= APP_NAME ?></strong>.
     Harsh Ghanshyambhai Nakrani (8812036) , Shiv Laxmanbhai Ahir (8809928) , Harshil Anirudhkumar Trivedi (8804546)
 </footer>

 <script>
     function change_it() {

         var listValue = $("#sl_change_font").val();
         changeFont(document.getElementsByTagName("body")[0], listValue);
     }

     function changeFont(element, listValue) {
         console.log(element.style.fontSize);
         element.style.fontSize = listValue;
         for (var i = 0; i < element.children.length; i++) {
             changeFont(element.children[i]);
         }
     }
 </script>