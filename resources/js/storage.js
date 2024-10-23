export default {
    get(key) {
        const value = localStorage.getItem(key);

        return new Promise((resolve, reject) => {
            if (value === null) {
                reject(`No value for given key: ${key}`);
            }

            resolve(JSON.parse(value));
        });
    },
    put(key, value) {
        return new Promise((resolve, reject) => {
            localStorage.setItem(key, value);

            resolve(this.get(key));
        });
    },
    remove(key) {
        localStorage.removeItem(key);
    },
};
