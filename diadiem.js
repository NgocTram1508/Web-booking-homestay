const images1 = document.querySelector('.listimages');
const imgContainers = document.querySelectorAll('.listimages .anh_container');
const btnL1 = document.querySelector('.btnL1 ');
const btnR1 = document.querySelector('.btnR1 ');

let j = 0; // Vị trí hiện tại

btnL1.addEventListener('click', () => {
    const containerWidth = imgContainers[0].offsetWidth; // Chiều rộng mỗi phần tử
    var dai=containerWidth+10;
    const maxIndex = imgContainers.length ; // Số lần dịch chuyển tối đa

    if (j > 0) {
        j--; // Di chuyển ngược lại
        images1.style.transform = `translateX(${(-dai ) * j}px)`;
    }

    // Hiển thị/ẩn nút
    btnR1.style.display = 'block';
    if (j === 0) btnL1.style.display = 'none';
});

btnR1.addEventListener('click', () => {
    const containerWidth = imgContainers[0].offsetWidth;
    const maxIndex = imgContainers.length -4;
    var dai=containerWidth+10;
    if (j < maxIndex) {
        j++; // Di chuyển về phía trước
        images1.style.transform = `translateX(${-dai* j}px)`;
    }

    // Hiển thị/ẩn nút
    btnL1.style.display = 'block';
    if (j === maxIndex) btnR1.style.display = 'none';
});

// Ẩn nút trái lúc đầu
btnL1.style.display = 'none';
