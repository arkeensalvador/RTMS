const fund_code = document.getElementById('fund_code')
const form = document.getElementById('regiration_form')
const errorElement = document.getElementById('error')

form.addEventListener('submit', (e) => {
    let messages = []
    if(fund_code.value === '' || fund_code.value === null ) {
        messages.push ('Fund Code is required')
    }

    if(messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    }
})
