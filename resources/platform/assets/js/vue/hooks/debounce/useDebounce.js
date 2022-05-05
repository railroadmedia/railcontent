import { ref, customRef } from 'vue'

const myDebounce = (fn, delay = 0, immediate = false) => {
    let timeout
    return (...args) => {
        if (immediate && !timeout) fn(...args)
        clearTimeout(timeout)

        timeout = setTimeout(() => {
            fn(...args)
        }, delay)
    }
}

const useDebounce = (initialValue, delay, immediate) => {
    const state = ref(initialValue)
    const debouncedReference = customRef(
        (myTrack, myTrigger) => ({
            get() {
                myTrack()
                return state.value
            },
            set: myDebounce(
                value => {
                    state.value = value
                    myTrigger()
                },
                delay,
                immediate
            ),
        })
    )
    return debouncedReference
}

const useDebounceFn = (fn, delay) => {
    let timeout

    return (...args) => {
        if (timeout) {
            clearTimeout(timeout)
        }

        timeout = setTimeout(() => {
            fn(...args)
        }, delay)
    }
}

export {
    useDebounce,
    useDebounceFn
}
