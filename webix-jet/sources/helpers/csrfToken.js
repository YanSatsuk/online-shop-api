function getCsrfToken() {
    let token;
    let selector = document.querySelector("meta[name='csrf-token']");
    if (selector) {
        token = selector.getAttribute('content');
    }
    return token;
}

export {
    getCsrfToken
}
