<?php
function productCard(
    $productID,
    $productCode,
    $productName,
    $categoryID,
    $categoryName,
    $unitID,
    $unitName,
    $price,
    $stock,
    $description,        
    $buttonText,
    $buttonIcon = '',
    $extraClasses = ''
) {
    if (mb_strlen($description) > 100) {
        $description = mb_substr($description, 0, 100) . '...';
    }

    return "
    <form method='POST' class='flex flex-col bg-white border shadow-sm rounded-xl $extraClasses'>
        <input type='hidden' name='id' value='$productID'>
        <input type='hidden' name='code' value='$productCode'>
        <input type='hidden' name='name' value='$productName'>
        <input type='hidden' name='m_category_id' value='$categoryID'>
        <input type='hidden' name='m_unit_id' value='$unitID'>
        <input type='hidden' name='price' value='$price'>
        <input type='hidden' name='stock' value='$stock'>
        <div class='bg-gray-100 border-b rounded-t-xl py-1.5 px-4 md:py-2.5 md:px-5'>
            <p class='mt-1 text-sm text-gray-500'>
                $categoryName
            </p>
        </div>
        <div class='p-4 md:p-5 flex flex-col h-full justify-between'>
            <div class=''>
            <h3 class='text-base font-bold text-gray-800'>
                $productName
            </h3>
            <p class='mt-2 text-gray-500 text-sm'>
                $description
            </p>
            </div>
            <div class='w-full mt-3 flex flex-wrap items-center justify-between'>
                <button type='submit' name='add_to_cart' class='inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none'>
                    $buttonIcon
                    <span class=''>$buttonText</span>
                </button>
                <p class='font-medium text-sm'>".toIdr($price)."/<span class='text-gray-500'>$unitName</span></p>
            </div>
        </div>
    </form>";
}
