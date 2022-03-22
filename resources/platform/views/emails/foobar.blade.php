<h1>This is fwon!</h1>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    /*axios.post('/mailora/public/send', { */
    axios.post('/mailora/secure/send', {

        // type-specific
        //     'type': 'foobar',
        //     'value-test-1': 'value-test-1-contents'

            'type': 'layouts/action',
            'lines': [
                'foo_lines_bar_line_1',
                'foo_lines_bar_line_2',
                'foo_lines_bar_line_3',
                'foo_lines_bar_line_4',
                'foo_lines_bar_line_5',
                'foo_lines_bar_line_6'
            ],
            'callToAction': {
                'url': 'foo_callToAction_bar',
                'text': 'foo_callToAction_bar',
            },
            'logo': 'foo_logo_bar',
            'brand': 'foo_brand_bar',
            'subject': 'important action!!'

        // general mailora options
            // 'sender-address' : 'bar@some-domain.com',
            // 'sender-name' : 'Baz Qux',
            // 'recipient-address' : 'quux@other-domain.com',
            // 'recipient-name' : 'Corge Uier',
            // 'subject' : 'Grault garply waldo',
    })
        .then(function (response) {
            // handle success
            console.log(response);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
</script>