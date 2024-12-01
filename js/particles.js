// Рухомі частинки заднього фону
// <canvas id="particleCanvas"></canvas>
// <script src="jsscripts/particles.js"></script>


const canvas = document.getElementById("particleCanvas");
const ctx = canvas.getContext("2d");

// Налаштування розміру canvas
function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
window.addEventListener("resize", resizeCanvas);
resizeCanvas();

// Параметри частинок
const particles = [];
const numParticles = 80;
const maxDistance = 70;
const speed = 2;

// Масив розмірів частинок
const particleSizes = [0.5, 1, 1.5]; // Три розміри частинок

// Створення класу Particle
class Particle {
    constructor() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.vx = (Math.random() - 0.5) * speed;
        this.vy = (Math.random() - 0.5) * speed;
        this.size = particleSizes[Math.floor(Math.random() * particleSizes.length)]; // Випадковий розмір
    }

    // Оновлення положення частинки
    update() {
        this.x += this.vx;
        this.y += this.vy;

        // Зворотне переміщення, якщо виходить за межі
        if (this.x < 0 || this.x > canvas.width) this.vx *= -1;
        if (this.y < 0 || this.y > canvas.height) this.vy *= -1;
    }

    // Відображення частинки
    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fillStyle = "rgba(0, 255, 200, 0.8)";
        ctx.shadowBlur = 10;
        ctx.shadowColor = "rgba(0, 255, 200, 0.8)";
        ctx.fill();
    }
}

// Ініціалізація частинок
for (let i = 0; i < numParticles; i++) {
    particles.push(new Particle());
}

// Анімація
function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Перевірка відстані між частинками та малювання ліній
    for (let i = 0; i < particles.length; i++) {
        for (let j = i + 1; j < particles.length; j++) {
            const dx = particles[i].x - particles[j].x;
            const dy = particles[i].y - particles[j].y;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < maxDistance) {
                ctx.beginPath();
                ctx.moveTo(particles[i].x, particles[i].y);
                ctx.lineTo(particles[j].x, particles[j].y);
                ctx.strokeStyle = "rgba(0, 255, 200, 0.3)";
                ctx.shadowBlur = 8;
                ctx.shadowColor = "rgba(0, 255, 200, 0.3)";
                ctx.stroke();
            }
        }
    }

    // Оновлення і відображення частинок
    particles.forEach(particle => {
        particle.update();
        particle.draw();
    });

    requestAnimationFrame(animate);
}

animate();