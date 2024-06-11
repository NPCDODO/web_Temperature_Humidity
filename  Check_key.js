document.addEventListener("DOMContentLoaded", function() {
    // เลือกทุกข้อมูลที่มีค่า Temperature สูงกว่า 30C
    let temperatureItems = document.querySelectorAll('.data-item > div:nth-child(odd):not(:first-child):not(:last-child)');

    temperatureItems.forEach(function(item) {
        // แปลงค่าอุณหภูมิจาก string เป็นตัวเลขและตรวจสอบว่ามากกว่า 30 หรือไม่
        let temperature = parseFloat(item.textContent);
        if (!isNaN(temperature) && temperature > 30) {
            // เพิ่ม class "red-text" เพื่อเปลี่ยนสีข้อความเป็นสีแดง
            item.classList.add('red-text');
        }
    });
});
