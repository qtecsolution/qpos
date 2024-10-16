// src/utils/audioUtils.js
const playSound = (soundFile) => {
    const audio = new Audio(soundFile);
    audio.play().catch((error) => {
        console.error("Error playing sound:", error);
    });
};

export default playSound;
