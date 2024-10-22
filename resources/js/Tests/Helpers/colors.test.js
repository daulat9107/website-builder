import {
    getHueFromHex,
    getLightnessFromHex,
    getSaturationFromHex,
    getHighestLightness,
    getSteps,
    hslToHex,
    generateColorShades,
} from "../../Helpers/colors";

test("test get hue from hex code #2409D0", () => {
    expect(getHueFromHex("#2409D0")).toBe(248.14070351758795);
});

test("test get steps to generate a total number of 11 colors steps value should be 0.045454545454545456", () => {
    expect(getSteps(11)).toBe(0.045454545454545456);
});

test("test get highest lightness from hex code #2409D0", () => {
    let lightness = getLightnessFromHex("#2409D0");
    let steps = getSteps(11);
    expect(getHighestLightness(lightness, steps)).toBe(0.9709447415329768);
});

test("test get lightness from hex code #2409D0", () => {
    expect(getLightnessFromHex("#2409D0")).toBe(0.42549019607843136);
});
test("test get saturation from hex code #2409D0", () => {
    expect(getSaturationFromHex("#2409D0")).toBe(0.9170506912442397);
});
test("test hsl To hex", () => {
    let hue = getHueFromHex("#2409D0");
    let saturation = getSaturationFromHex("#2409D0");
    let lightness = getLightnessFromHex("#2409D0");
    expect(hslToHex(hue, saturation, lightness)).toBe("#2409D0");
});
test("test that we will obtain 11 color variations for the given color #2409D0 in the correct format.", () => {
    let shades = generateColorShades("#2409D0", 11);
    let counter = 0;
    for (let i = 0; i < shades.length; i++) {
        if (shades[i].shade.length == 7) counter++;
    }
    expect(counter).toBe(11);
});
test("test that we will obtain 11 color variations for any colors in the correct format.", () => {
    let shades = generateColorShades("#E9E7F5", 11);
    let counter = 0;
    for (let i = 0; i < shades.length; i++) {
        if (shades[i].shade.length == 7) counter++;
    }
    expect(counter).toBe(11);

    let shades2 = generateColorShades("#E9E7F5", 11);
    let counter2 = 0;
    for (let i = 0; i < shades2.length; i++) {
        if (shades2[i].shade.length == 7) counter2++;
    }
    expect(counter2).toBe(11);

    let shades3 = generateColorShades("#0C0D0D", 11);
    let counter3 = 0;
    for (let i = 0; i < shades3.length; i++) {
        if (shades3[i].shade.length == 7) counter3++;
    }
    expect(counter3).toBe(11);

    let shades4 = generateColorShades("#919191", 11);
    let counter4 = 0;
    for (let i = 0; i < shades4.length; i++) {
        if (shades4[i].shade.length == 7) counter4++;
    }
    expect(counter4).toBe(11);
});

test("test that we will get first value of color code as 50", () => {
    let shades = generateColorShades("#2409D0", 11);
    expect(shades[0].code).toBe(50);
});

test("test that we will get last value of color code as 950", () => {
    let shades = generateColorShades("#2409D0", 11);
    expect(shades[10].code).toBe(950);
});

test("test that we will get third value of color code as 200", () => {
    let shades = generateColorShades("#2409D0", 11);
    expect(shades[2].code).toBe(200);
});

test("test that first lightness value is equal to highest lightness", () => {
    const baseLightness = getLightnessFromHex("#2409D0");
    let steps = getSteps(11);
    let highestLightness = getHighestLightness(baseLightness, steps);
    let i = 0;
    let lightness = 1;
    lightness = highestLightness - i * steps;
    expect(lightness).toBe(highestLightness);
});

test("test that second lightness value is equal to highest lightness - steps * 2", () => {
    const baseLightness = getLightnessFromHex("#2409D0");
    let steps = getSteps(11);
    let highestLightness = getHighestLightness(baseLightness, steps);
    let i = 1;
    let lightness = 1;
    lightness = parseFloat((highestLightness - i * steps * 2).toFixed(3));
    expect(lightness).toBe(
        parseFloat((highestLightness - 0.0909090909).toFixed(3))
    );
});

test("test that last lightness value is equal to highest lightness - 10 * steps * 2", () => {
    const baseLightness = getLightnessFromHex("#2409D0");
    let steps = getSteps(11);
    let highestLightness = getHighestLightness(baseLightness, steps);
    let i = 1;
    let lightness = 1;
    lightness = parseFloat((highestLightness - i * steps * 2).toFixed(3));
    expect(lightness).toBe(
        parseFloat((highestLightness - 0.0909090909).toFixed(3))
    );
});
