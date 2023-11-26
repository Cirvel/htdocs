function getExtension(filename) {
    var parts = filename.split('.'); // Splits the name from 'file.zip' from '.'
    return parts[parts.length - 1]; // Removes the '.' in '.zip'
  }
  
  function isWinrar(filename) { // Check for winrar
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
      case 'zip':
      case 'rar':
      //etc
      return true;
    }
    return false;
  }

  function upload() {
    var file = $('#download'); // Find the value from input that has the name 'file' (ex. 'fileToUpload','ImageUpload')
    if (!isWinrar(file.val())) {
      alert('Uploaded file is not a winrar type');
      return false;
    }

    // success at this point
    // indicate success with alert for now
    alert('Mod successfully uploaded');
  }
  function editing() {
    var file = $('#download'); // Find the value from input that has the name 'file' (ex. 'fileToUpload','ImageUpload')
    if (file.val) {
      if (!isWinrar(file.val())) {
        alert('Uploaded file is not a winrar type');
        return false;
      }
    }
    
    // success at this point
    // indicate success with alert for now
    alert('Mod successfully updated');
  } 