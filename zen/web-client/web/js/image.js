const IMG_WIDTH = 120;
const IMG_HEIGHT = 120;

/**
 * 画像切り取り
 */
function cropResizeImage(image) {
    var canvas = document.createElement('canvas');
    console.log(image.width);
    var calc = calcCrop(image.width, image.height);

    canvas.width = IMG_WIDTH;
    canvas.height = IMG_HEIGHT;
    canvas.getContext('2d').drawImage(image, calc.left, calc.top, calc.width, calc.height, 0, 0, IMG_WIDTH, IMG_HEIGHT);
    var cropImage = new Image();
    cropImage.src = canvas.toDataURL("image/png");

    return cropImage;
}

/**
 * 画像切り取り計算
 */
function calcCrop(width, height) {
    var calcLeft;
    var calcTop;
    var calcWidth;
    var calcHeight;

    if (height > width) {
        calcHeight = (width / height) * height;
        calcWidth = width;
        calcTop = (height - calcHeight) / 2;
        calcLeft = 0;

    } else {
        calcWidth = (height / width) * width;
        calcHeight = height;
        calcTop = 0;
        calcLeft = (width - calcWidth) / 2;
    }

    return {left: calcLeft, top:calcTop,  width: calcWidth, height: calcHeight}
}

/**
 * 画像挿入
 */
function insertImage(image) {
    var escapeImageSrc = $("<div/>").text(image.src).html();
    $(".image-result").html('<img class="post-image" src="' + escapeImageSrc + '">');
}
