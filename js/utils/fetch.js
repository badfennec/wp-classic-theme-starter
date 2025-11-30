
/**
 * A utility module to handle fetch requests with timeout and error handling.
 * @param {{url: string, fetchOptions?: object, headers?: object, timeout?: number}} param0 
 * @returns 
 */
async function fetchData({ url, fetchOptions = {}, headers = {}, timeout = 5000 }) {
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), timeout);

    const config = {
        ...fetchOptions,
        signal: controller.signal,
        headers: {
            ...headers,
        }
    }

    try {

        const responseRequest = await fetch(url, config);

        clearTimeout(timeoutId);

        if( !responseRequest.ok ) {
            throw new Error( `HTTP error! status: ${responseRequest.status}` );
        }

        const response =  await responseRequest.json();

        if (response){
            return response;
        } else {
            throw new Error( 'Fetch request failed' );
        }        

    } catch (error) {

        clearTimeout(timeoutId);

        throw error;

    } finally {

        clearTimeout(timeoutId);

    }
}

/**
 * Utility function to fetch data from WordPress REST API.
 * 
 * @param {{endpoint: string, fetchOptions?: object, headers?: object, timeout?: number}} param0 
 * @returns 
 */
async function fetchRest({ endpoint, fetchOptions = {}, headers = {}, timeout = 5000 }) {
    const response = await fetchData({ 
        url: `${vctheme.rest_url}${endpoint}`,
        headers: {
            'X-WP-Nonce': `${vctheme.rest_nonce}`,
            ...headers,
        },
        fetchOptions,
        timeout
    });

    return response;
}

/**
 * Utility function to fetch data from WordPress AJAX endpoint.
 * 
 * @param {{url: string, fetchOptions?: object, headers?: object, timeout?: number}} param0 
 * @returns 
 */
async function wpFetchData({ url, fetchOptions, headers, timeout = 5000 }) {
    
    const response = await fetchData({ 
        url, 
        headers: {
            'x-nonce': `${vctheme.ajax_nonce}`
        },
        fetchOptions: { method: 'POST', ...fetchOptions },
        timeout
    });

    if (response.success){
        return response.data;
    } else {
        throw new Error( response?.data?.message || 'Fetch request failed' );
    }
}

export {
    fetchData,
    fetchRest,
    wpFetchData,
}