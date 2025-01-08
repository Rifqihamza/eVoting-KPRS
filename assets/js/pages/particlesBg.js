document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("particleCanvas");
    const ctx = canvas.getContext("2d");
  
    const particles = [];
    const numParticles = 100;
  
    const resizeCanvas = () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    };
  
    const createParticles = () => {
      for (let i = 0; i < numParticles; i++) {
        particles.push({
          x: Math.random() * canvas.width,
          y: Math.random() * canvas.height,
          size: Math.random() * 3 + 1, // Particle size between 1 and 4
          speedX: Math.random() * 0.5 - 0.25, // Random horizontal speed
          speedY: Math.random() * 0.5 - 0.25, // Random vertical speed
        });
      }
    };
  
    const drawParticles = () => {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particles.forEach((particle) => {
        ctx.beginPath();
        ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
        ctx.fillStyle = "rgba(255, 255, 255, 0.8)";
        ctx.fill();
      });
    };
  
    const animate = () => {
      particles.forEach((particle) => {
        particle.x += particle.speedX;
        particle.y += particle.speedY;
  
        // If particle moves out of the canvas, reset it to a random position
        if (particle.x > canvas.width || particle.x < 0) particle.speedX *= -1;
        if (particle.y > canvas.height || particle.y < 0) particle.speedY *= -1;
      });
      drawParticles();
      requestAnimationFrame(animate);
    };
  
    // Initialize
    resizeCanvas();
    createParticles();
    animate();
  
    window.addEventListener("resize", resizeCanvas);
  });
  