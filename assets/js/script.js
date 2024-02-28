document.addEventListener("DOMContentLoaded", function() {
    const hoverImage = document.getElementById('hover-image');
    const container = document.getElementById('container');
  
    container.addEventListener('mouseenter', function() {
      const imageSrc = hoverImage.getAttribute('src');
      container.style.backgroundColor = getAverageColor(imageSrc);
    });
  
    container.addEventListener('mouseleave', function() {
      container.style.backgroundColor = ''; // Reset background color on mouse leave
    });
  
    // Function to get the average color of an image
    function getAverageColor(imageSrc) {
      const img = new Image();
      img.src = imageSrc;
      img.crossOrigin = "Anonymous"; // To avoid CORS issues
      const canvas = document.createElement('canvas');
      const ctx = canvas.getContext('2d');
  
      img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0, img.width, img.height);
        const imageData = ctx.getImageData(0, 0, img.width, img.height);
        const data = imageData.data;
        let total = 0;
        for (let i = 0; i < data.length; i += 4) {
          total += (data[i] + data[i + 1] + data[i + 2]) / 3; // Average RGB value
        }
        const average = total / (img.width * img.height);
        const averageColor = 'rgb(' + average + ',' + average + ',' + average + ')';
        container.style.backgroundColor = averageColor;
      };
    }
  });
  