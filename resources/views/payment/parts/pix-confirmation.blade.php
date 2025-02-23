@vite(['resources/css/custom.css'])
<div id="pix-qr-code" class="mt-4">
    <div id="loading" class="loader mt-4 mx-auto"></div>
</div>
<script>    
    const loading = document.querySelector('#loading');
    loading.classList.remove('hidden');
    fetch("{{ route('payment.getQrCode',['asaasId'=>$response->asaas_id]) }}", {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(response => {
        console.log(response);
        if (response.data.encodedImage) {
            const img = document.createElement('img');
            img.src = `data:image/png;base64,${response.data.encodedImage}`;
            img.alt = "PIX QR Code";
            img.classList.add('mt-4', 'mx-auto', 'max-w-xs', 'shadow-md');

            const text = document.createElement('p');
            text.innerHTML = `<b>Pix copia e cola:</b> <span>${response.data.payload}</span>`;
            text.classList.add('text-center', 'text-gray-700');

            document.querySelector('#pix-qr-code').appendChild(text);
            document.querySelector('#pix-qr-code').appendChild(img);
            loading.classList.add('hidden');
        } else {
            loading.classList.add('hidden');
            console.error('No QR Code response received');
        }
    })
    .catch(error => {
        loading.classList.add('hidden');
        console.error('Error fetching PIX QR Code:', error);
    })
</script>