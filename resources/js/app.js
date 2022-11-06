import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import "@lottiefiles/lottie-player";
import "venobox";

window.inputBox = async function(folderForm,folderName){
    const { value: name } = await Swal.fire({
        title: 'Folder Create',
        input: 'text',
        inputPlaceholder: 'Enter the folder name'
      })

      if (name) {
        folderName.value = name;
        folderForm.submit();
      }
}

window.showToast = function(message){

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: message
      })
}

window.Alpine = Alpine;

Alpine.start();

