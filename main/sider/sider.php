<div class="flex h-screen flex-col justify-between border-e bg-[#f2f2f2] fixed w-[260px]">
  <div class="px-4 py-4">
    <div class="flex gap-4 items-center border-b pb-4">
      <img src="https://placehold.co/400" alt="" class="w-12 h-12 rounded-full">
      <h1>Logo</h1>
    </div>

    <ul class="mt-6 space-y-1">
      <?php foreach ($list_menu as $menu): ?>
        <?php if (isset($menu['submenu'])): ?>
          <!-- Dropdown menu -->
          <details class="group [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-[#ef9a2e] hover:text-white">
              <span class="flex items-center gap-2">
                <?= $menu['icon'] ?>
                <span class="text-sm font-medium"><?= $menu['label'] ?></span>
              </span>
              <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
              </span>
            </summary>
            <ul class="mt-2 space-y-1 px-4">
              <?php foreach ($menu['submenu'] as $submenu): ?>
                <li>
                  <a href="<?= $submenu['url'] ?>" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-[#ef9a2e] hover:text-white">
                    <?= $submenu['label'] ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </details>
        <?php else: ?>
          <!-- Single menu item -->
          <li>
            <a href="<?= $menu['url'] ?>" class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-[#ef9a2e] hover:text-white">
              <?= $menu['icon'] ?>
              <span><?= $menu['label'] ?></span>
            </a>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="sticky inset-x-0 bottom-0 border-t border-gray-100 p-4">
    <div class="flex items-center justify-between gap-2 bg-[#1d1d1d] p-4 rounded-xl">
      <div class="text-white flex items-center gap-4">
        <img alt="" src="https://placehold.co/400" class="size-10 rounded-full object-cover" />
        <p class="text-xs">
          <strong class="block font-medium text-[#ef9a2e]">Administrator</strong>
          <span> Budi </span>
        </p>
      </div>
      <a href="" class="flex items-center hover:bg-[#2d2d2d] p-2 rounded-lg">
        <i class="text-[1.1rem] bx bx-exit text-red-600"></i>
      </a>
    </div>
  </div>
</div>