<?php
function baseFileUpload(
  $label,
  $name,
  $required = false,
  $allowedTypes = ['image/png', 'image/jpeg', 'application/pdf'],
  $maxSize = 5242880,
  $uploadPath = ''
) {
  $requiredAttr = $required ? 'required' : '';
  $requiredLabel = $required ? ' <span class="text-red-500">*</span>' : '';
  $acceptAttr = implode(',', $allowedTypes);
  
  $allowedExtensions = [];
  foreach ($allowedTypes as $type) {
      if ($type == 'image/png') $allowedExtensions[] = '.png';
      if ($type == 'image/jpeg') $allowedExtensions[] = '.jpg, .jpeg';
      if ($type == 'application/pdf') $allowedExtensions[] = '.pdf';
  }
  $allowedExtText = implode(', ', $allowedExtensions);
  
  $uniqueId = 'file_' . uniqid();
  
  return "
  <div>
      <label class='block text-sm font-medium text-gray-700'>{$label}{$requiredLabel}</label>
      <div class='mt-1 flex flex-col gap-2'>
          <input 
              type='file' 
              name='{$name}' 
              id='{$uniqueId}'
              accept='{$acceptAttr}' 
              class='block w-full text-sm text-gray-500
              file:mr-4 file:py-2 file:px-4
              file:rounded-lg file:border-0
              file:text-sm file:font-semibold
              file:bg-blue-50 file:text-blue-700
              hover:file:bg-blue-100'
              {$requiredAttr}
              onchange='previewFile(this)'
          />
          
          <div id='preview-{$uniqueId}' class='preview-container hidden mt-2'>
              <div id='image-container-{$uniqueId}' class='relative inline-block hidden'>
                  <img id='image-preview-{$uniqueId}' class='max-h-40 rounded border' alt='Preview' />
                  <button type='button' id='image-remove-btn-{$uniqueId}' 
                      class='absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-sm hover:bg-red-600 transition-colors'
                      onclick='removeFile(\"{$uniqueId}\")'>
                      <svg xmlns='http://www.w3.org/2000/svg' class='h-4 w-4' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                          <line x1='18' y1='6' x2='6' y2='18'></line>
                          <line x1='6' y1='6' x2='18' y2='18'></line>
                      </svg>
                  </button>
              </div>
              
              <div id='pdf-preview-{$uniqueId}' class='hidden inline-block'>
                  <div class='flex items-center border rounded p-3 bg-gray-50'>
                      <svg xmlns='http://www.w3.org/2000/svg' class='h-8 w-8 text-red-500' viewBox='0 0 24 24'>
                          <path fill='currentColor' d='M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20M10.92,12.31C10.68,11.54 10.15,9.08 11.55,9.04C12.95,9 12.03,12.16 12.03,12.16C12.42,13.65 14.05,14.72 14.05,14.72C14.55,14.57 17.4,14.24 17,15.72C16.57,17.2 13.5,15.87 13.5,15.87C11.55,15.16 10.85,16.13 10.85,16.13C10.31,17.57 8.12,19.22 7.28,17.7C6.45,16.19 9.23,14.64 9.23,14.64C10.21,13.54 10.92,12.31 10.92,12.31M13.37,14.41C13.37,14.41 12.76,13.84 12.43,12.83C12.1,11.82 12.36,11.17 12.36,11.17C12.36,11.17 12.11,12.3 12.44,13.38C12.77,14.47 13.37,14.41 13.37,14.41M14.69,14.31C14.69,14.31 15.97,13.75 15.88,13.5C15.78,13.25 15.39,13.26 15.39,13.26C15.39,13.26 16.37,13.06 16.56,13.97C16.75,14.88 14.69,14.31 14.69,14.31M8.63,17.17C8.63,17.17 8.5,16.04 10.29,15.11C12.09,14.18 11.69,16.160 11.69,16.16C11.69,16.16 9.62,17.38 8.63,17.17Z'/>
                      </svg>
                      <span class='ml-2 text-sm text-gray-600'>PDF Document</span>
                      
                      <button type='button'
                          class='ml-2 text-red-500 hover:text-red-700 transition-colors'
                          onclick='removeFile(\"{$uniqueId}\")'>
                          <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                              <line x1='18' y1='6' x2='6' y2='18'></line>
                              <line x1='6' y1='6' x2='18' y2='18'></line>
                          </svg>
                      </button>
                  </div>
              </div>
          </div>
      </div>
      <p class='mt-1 text-xs text-gray-500'>Allowed file types: {$allowedExtText}. Max size: " . ($maxSize / 1048576) . "MB</p>
  </div>
  
  <script>
  function previewFile(input) {
      const file = input.files[0];
      const previewId = 'preview-' + input.id;
      const imageContainerId = 'image-container-' + input.id;
      const imagePreviewId = 'image-preview-' + input.id;
      const pdfPreviewId = 'pdf-preview-' + input.id;
      
      const previewContainer = document.getElementById(previewId);
      const imageContainer = document.getElementById(imageContainerId);
      const imagePreview = document.getElementById(imagePreviewId);
      const pdfPreview = document.getElementById(pdfPreviewId);
      
      if (!file) {
          previewContainer.classList.add('hidden');
          return;
      }
      
      previewContainer.classList.remove('hidden');
      
      if (file.type.startsWith('image/')) {
          imageContainer.classList.remove('hidden');
          pdfPreview.classList.add('hidden');
          
          const reader = new FileReader();
          reader.onload = function(e) {
              imagePreview.src = e.target.result;
          }
          reader.readAsDataURL(file);
      } else if (file.type === 'application/pdf') {
          imageContainer.classList.add('hidden');
          pdfPreview.classList.remove('hidden');
      } else {
          previewContainer.classList.add('hidden');
      }
  }
  
  function removeFile(inputId) {
      const fileInput = document.getElementById(inputId);
      const previewContainer = document.getElementById('preview-' + inputId);
      const imageContainer = document.getElementById('image-container-' + inputId);
      const pdfPreview = document.getElementById('pdf-preview-' + inputId);
      
      fileInput.value = '';
      
      previewContainer.classList.add('hidden');
      imageContainer.classList.add('hidden');
      pdfPreview.classList.add('hidden');
      
      if (fileInput.hasAttribute('required-temp')) {
          fileInput.setAttribute('required', '');
          fileInput.removeAttribute('required-temp');
      }
  }
  </script>
  ";
}


function processFileUpload($fileInputName, $targetDirectory, $allowedTypes = ['image/png', 'image/jpeg', 'application/pdf'], $maxSize = 5242880) {
  if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
      return [
          'success' => false,
          'message' => 'No file uploaded or upload error occurred.'
      ];
  }
  
  $file = $_FILES[$fileInputName];
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileType = $file['type'];
  
  if ($fileSize > $maxSize) {
      return [
          'success' => false,
          'message' => 'File is too large. Maximum size is ' . ($maxSize / 1048576) . 'MB.'
      ];
  }
  
  if (!in_array($fileType, $allowedTypes)) {
      return [
          'success' => false,
          'message' => 'Invalid file type. Allowed types: ' . implode(', ', $allowedTypes)
      ];
  }
  
  $uploadDir = __DIR__ . '/../../public/uploads/' . $targetDirectory . '/';
  if (!file_exists($uploadDir)) {
      mkdir($uploadDir, 0777, true);
  }
  
  $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
  $newFileName = uniqid() . '.' . $fileExtension;
  $targetFilePath = $uploadDir . $newFileName;
  
  $relativePath = 'uploads/' . $targetDirectory . '/' . $newFileName;
  
  if (move_uploaded_file($fileTmpName, $targetFilePath)) {
      return [
          'success' => true,
          'message' => 'File uploaded successfully!',
          'fileName' => $newFileName,
          'filePath' => $relativePath,
          'absolutePath' => $targetFilePath,
          'fileType' => $fileType
      ];
  } else {
      return [
          'success' => false,
          'message' => 'Failed to move uploaded file.'
      ];
  }
}
?>