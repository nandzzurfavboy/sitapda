<form method="GET" action="">
  <input type="hidden" name="page" value="material">
  <div class="relative">
    <div class="absolute flex items-center ml-2 h-full">
      <i class='bx bx-search'></i>
    </div>
    <input type="text" name="search" placeholder="Search by name or category ..." class="px-8 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
  </div>
  <div class="flex items-center justify-between mt-4">
    <p class="font-medium">
      Filters
    </p>
    <div class="inline-flex gap-2">
      <button type="submit" class="flex items-center gap-1 px-4 py-2 bg-green-700 hover:bg-green-800 text-white text-sm font-medium rounded-md">
        Apply Filter
        <i class='bx bx-navigation text-[1.1rem]'></i>
      </button>
      <a href="?page=material" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
        Reset Filter
      </a>
    </div>
  </div>
  <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 mt-4">
    <?= customSelect('m_category_id', $listCategories, 'id', 'name', 'All category', isset($_GET['m_category_id']) ? $_GET['m_category_id'] : '') ?>
    <?= customSelect('m_unit_id', $listUnit, 'id', 'name', 'All unit', isset($_GET['m_unit_id']) ? $_GET['m_unit_id'] : '') ?>
  </div>
</form>