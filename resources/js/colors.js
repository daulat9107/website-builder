export const colorsBg = {
    white: "bg-background-50 text-text-950",
    light: "bg-background-100 text-text-950",
    success: "bg-success-800 text-text",
    danger: "bg-danger-500 text-text",
    warning: "bg-warning-800 text-text",
    info: "bg-info text-text",
};

export const colorsBgHover = {
    white: "hover:bg-background-50",
    light: "hover:bg-background-200",
    success: "hover:bg-success-900",
    danger: "hover:bg-danger-600",
    warning: "hover:bg-warning-900",
    info: "hover:bg-info-600",
};

export const colorsBorders = {
    white: "border-background-300",
    light: "border-background-200 dark:border-background-400",
    success: "border-success-600",
    danger: "border-danger-600",
    warning: "border-warning-950",
    info: "border-info-600",
};

export const colorsText = {
    white: "text-text-950 dark:text-text-100",
    light: "text-text-700 dark:text-text-400",
    success: "text-text-500",
    danger: "text-text-500",
    warning: "text-text",
    info: "text-info",
};

export const colorsOutline = {
    white: [colorsText.white, colorsBorders.white],
    light: [colorsText.light, colorsBorders.light],
    success: [colorsText.success, colorsBorders.success],
    danger: [colorsText.danger, colorsBorders.danger],
    warning: [colorsText.warning, colorsBorders.warning],
    info: [colorsText.info, colorsBorders.info],
};

export const colorsOutlineHover = {
    white: "hover:bg-background-100 hover:text-text-900 dark:hover:text-text-900",
    light: "hover:bg-background-100 hover:text-text-900 dark:hover:text-text-900",
    success: "hover:bg-success-500 hover:text-text",
    danger: "hover:bg-danger-500 hover:text-text",
    warning: "hover:bg-warning-950 hover:text-text",
    info: "hover:bg-info hover:text-text",
};

export const getButtonColor = (color, isOutlined, hasHover) => {
    const base = [
        isOutlined ? colorsText[color] : colorsBg[color],
        colorsBorders[color],
    ];

    if (hasHover) {
        base.push(
            isOutlined ? colorsOutlineHover[color] : colorsBgHover[color]
        );
    }

    return base;
};
