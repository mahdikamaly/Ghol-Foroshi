
const imageInput = document.getElementById('image-input');
const imageElement = document.getElementById('image-element');




imageInput.onchange = (e) => {

    const file = e.target.files[0]
    console.log(file);

    const fileReader = new FileReader()


    fileReader.onload = (event) => {
        imageElement.src = fileReader.result
    }
    fileReader.readAsDataURL(file)

}