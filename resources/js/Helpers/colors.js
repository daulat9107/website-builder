export const getHueFromHex = (hex) => {
    const r = parseInt(hex.substring(1, 3), 16) / 255;
    const g = parseInt(hex.substring(3, 5), 16) / 255;
    const b = parseInt(hex.substring(5, 7), 16) / 255;
    const max = Math.max(r, g, b);
    const min = Math.min(r, g, b);
    const delta = max - min;
    let hue;

    if (delta === 0) {
        hue = 0;
    } else if (max === r) {
        hue = (g - b) / delta;
    } else if (max === g) {
        hue = 2 + (b - r) / delta;
    } else {
        hue = 4 + (r - g) / delta;
    }

    hue *= 60;
    if (hue < 0) {
        hue += 360;
    }

    return hue;
};
export const getHighestLightness = (lightness, steps) => {
    return lightness + steps * Math.floor((1 - lightness) / steps);
};
export const getSteps = (totalColors) => {
    return 1 / totalColors / 2;
};

export const getLightnessFromHex = (hex) => {
    const r = parseInt(hex.substring(1, 3), 16) / 255;
    const g = parseInt(hex.substring(3, 5), 16) / 255;
    const b = parseInt(hex.substring(5, 7), 16) / 255;
    const max = Math.max(r, g, b);
    const min = Math.min(r, g, b);
    const lightness = (max + min) / 2;

    return lightness;
};
export const getSaturationFromHex = (hex) => {
    const r = parseInt(hex.substring(1, 3), 16) / 255;
    const g = parseInt(hex.substring(3, 5), 16) / 255;
    const b = parseInt(hex.substring(5, 7), 16) / 255;
    const max = Math.max(r, g, b);
    const min = Math.min(r, g, b);
    const delta = max - min;
    let saturation;

    if (delta === 0) {
        saturation = 0;
    } else {
        saturation = delta / (1 - Math.abs(max + min - 1));
    }

    return saturation;
};
export const hslToHex = (hue, saturation, lightness) => {
    const chroma = saturation * (1 - Math.abs(2 * lightness - 1));
    const huePrime = hue / 60;
    const x = chroma * (1 - Math.abs((huePrime % 2) - 1));
    let r, g, b;

    if (huePrime < 1) {
        r = chroma;
        g = x;
        b = 0;
    } else if (huePrime < 2) {
        r = x;
        g = chroma;
        b = 0;
    } else if (huePrime < 3) {
        r = 0;
        g = chroma;
        b = x;
    } else if (huePrime < 4) {
        r = 0;
        g = x;
        b = chroma;
    } else if (huePrime < 5) {
        r = x;
        g = 0;
        b = chroma;
    } else {
        r = chroma;
        g = 0;
        b = x;
    }

    const m = lightness - 0.5 * chroma;
    r += m;
    g += m;
    b += m;

    r = Math.round(r * 255)
        .toString(16)
        .padStart(2, "0");
    g = Math.round(g * 255)
        .toString(16)
        .padStart(2, "0");
    b = Math.round(b * 255)
        .toString(16)
        .padStart(2, "0");

    return `#${r}${g}${b}`.toUpperCase();
};

export const generateColorShades = (color, numShades) => {
    const baseHue = getHueFromHex(color);
    const baseSaturation = getSaturationFromHex(color);
    const baseLightness = getLightnessFromHex(color);
    const shades = [];
    let steps = getSteps(numShades);
    let lightness = getHighestLightness(baseLightness, steps);
    for (let i = 0; i < numShades; i++) {
        const shade = {
            code: null,
            shade: null,
        };
        if (i == 0) {
            shade.code = 50;
        } else if (i == 1) {
            lightness = lightness - steps;
            shade.code = 100;
        } else if (i > 1 && i < numShades - 1) {
            shade.code = 100 * i;
            lightness = lightness - steps * 2;
        } else {
            shade.code = 100 * i - 50;
            lightness = lightness - steps;
        }
        shade.shade = hslToHex(baseHue, baseSaturation, lightness);
        shades.push(shade);
    }
    return shades;
};
