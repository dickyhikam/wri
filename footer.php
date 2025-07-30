 <footer class="bg-white border-t py-4 px-8 text-sm text-gray-600">
   <div class="flex justify-between items-center">
     <div>
       &copy; <span id="year"></span> Portal MIS. Dibuat oleh
       <a class="text-wri-blue font-medium" href="https://wri-indonesia.org/id" target="_blank">WRI Indonesia</a>.
     </div>
   </div>
 </footer>
 </main>
 </div>

 <script src="assets/js/charts.js"></script>
 <script>
   // Update tahun secara otomatis
   document.getElementById('year').textContent = new Date().getFullYear();

   // Function to remove non-numeric characters from an input
   function onlyNumber(inputElement) {
     // Remove any non-numeric characters
     inputElement.value = inputElement.value.replace(/\D/g, '');
   }
 </script>
 </body>

 </html>