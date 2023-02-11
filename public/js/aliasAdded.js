function copyUrlToClipboard() {
    window.navigator.clipboard.writeText(document.querySelector('#shortened_url').textContent)
    const copyToClipboard = document.querySelector('#copy_to_clipboard')
    copyToClipboard.textContent = 'Copied!'
    setTimeout(() => {
        copyToClipboard.textContent = 'Copy'
    }, 3000)
}
