<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Kategori Material Bangunan</h1>
      <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Jelajahi berbagai kategori material bangunan berkualitas tinggi yang kami sediakan untuk memenuhi kebutuhan proyek konstruksi Anda.</p>
    </div>
    <div class="flex flex-wrap -m-4">
      <?php
      $listCategory = getData("tb_category");
      foreach ($listCategory as $v) {
      ?>
        <div class="xl:w-1/3 md:w-1/2 p-4">
          <div class="bg-white border border-[#f7d190] p-6 rounded-lg h-full">
            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-[#ef9a2e] text-white mb-4">
              <i class='bx bx-cube-alt text-[1.4rem]'></i>
            </div>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-2"><?= $v['name'] ?></h2>
            <p class="leading-relaxed text-base">
              <?php
              $description = $v['description'];
              $shortDescription = (strlen($description) > 100) ? substr($description, 0, 100) . '...' : $description;
              echo htmlspecialchars($shortDescription);
              ?>
            </p>

          </div>
        </div>
      <?php } ?>
    </div>
    <a href="?page=material" class="w-fit flex items-center gap-1 mx-auto mt-16 text-white bg-black border-0 py-2 px-6 focus:outline-none hover:bg-black/90 rounded-lg text-sm">
      <span>Lihat Material</span>
      <i class='bx bx-right-top-arrow-circle text-[1.1rem]'></i>
    </a>
  </div>
</section>