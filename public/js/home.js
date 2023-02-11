document.addEventListener("DOMContentLoaded", () => {
    document.querySelector('#origin_url').setAttribute('type', 'text')
    document.querySelector('#protocol_tip').setAttribute('style', 'display: none;')
});

function formSubmitValidator() {
    const originUrl = document.querySelector('#origin_url')
    const currentUrl = originUrl.value
    if (!currentUrl.startsWith('http') && !currentUrl.startsWith('https')) {
        originUrl.value = 'https://' + currentUrl
    }
    return true
}
