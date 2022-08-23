import common from './default.js'

export default () => ({...common,
    ...{
        init() {
            console.log('Initialize Alpine on Sessions List');
        },
    }
})
