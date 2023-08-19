/************************
 * Indexed DB Utilities
 ************************/

/**
 * Open IndexedDB
 *
 * @param {string} dbName - Name of Database
 * @param {string} storeName - Name of Store within DB
 */
export function openDB(dbName, storeName) {
    const version = new Date().getTime(); //Need a unique version to add new Store
    return new Promise( (resolve, reject) => {
        const request = indexedDB.open(dbName, version);

        request.onupgradeneeded = function(event) {
            const db = event.target.result;
            if (!db.objectStoreNames.contains(storeName)) {
                db.createObjectStore(storeName);
            }
        }
        request.onerror = function(error) {
            reject("Error opening IndexedDB.");
        }
        request.onsuccess = function(event) {
            resolve(event.target.result);
        }
    })
}

/**
 * Save Data to IndexedDB
 *
 * @param {string} db - Name of Database
 * @param {string} storeName - Name of Store
 * @param {string} key - Name of Key within Store
 * @param {string} data - data to save to store
 */
export function saveToDB(db, storeName, key, data) {
    return new Promise( (resolve, reject) => {
        const transaction = db.transaction([storeName], "readwrite");
        const objectStore = transaction.objectStore(storeName);
        const request = objectStore.put(data, key);

        request.onerror = function(event) {
            reject("Error saving to IndexedDB.")
        };

        request.onsuccess = function(event) {
            resolve();
        }
    })
}

/**
 * Retrieve Data from IndexedDB
 * 
 * @param {string} db - Name of Database
 * @param {string} storeName - Name of Store
 * @param {string} key - Name of Key within Store
 */
export function getFromDB(db, storeName, key) {
    return new Promise( (resolve, reject) =>  {
        const transaction = db.transaction(storeName, 'readonly');
        const objectStore = transaction.objectStore(storeName);
        const request = objectStore.get(key);

        request.onsuccess = function(event) {
            resolve(request.result);
        }

        request.onerror = function(event) {
            reject("Error fetching data from IndexedDB.")
        };
    })
}

/**
 * Retrieve All Data from IndexedDB
 * 
 * @param {string} db - Name of Database
 * @param {string} storeName - Name of Store
 * @param {Array} key - Name of Keys you want to get the values for
 */
export function getMultipleFromDB(db, storeName, keys) {
    // Create an array of promises for each key
    const promises = keys.map(key => getFromDB(db, storeName, key));
    // Use Promise.all to execute all promises in parallel
    return Promise.all(promises);
}

/**
 * Check if store exists in IndexedDB
 * 
 * @param {string} dbName - Name of Database
 * @param {string} storeName - Name of Store
 */
export function storeExists(dbName, storeName) {
    return new Promise((resolve, reject) => {
        const openRequest = indexedDB.open(dbName);

        openRequest.onerror = function(event) {
            reject("Error opening IndexedDB.");
        }

        openRequest.onsuccess = function(event) {
            const db = event.target.result;
            if(db.objectStoreNames.contains(storeName)) {
                resolve(true); //The store exists
            } else {
                resolve(false); //The store doesn't exist
            }
        }
    })
}

