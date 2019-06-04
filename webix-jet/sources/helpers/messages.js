class Messages {
    static _showMessage(message) {
        webix.message({ text: message })
    }

    static _getErrors(error) {
        for (var e in error) {
            webix.message({
                text: error[e][0],
                type: 'error',
            })
        }
    }
}

export default Messages;
