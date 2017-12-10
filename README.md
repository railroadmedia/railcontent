# Railcontent

Data first simple CMS.

## Notes

### Progress-Bubbling

Something to watch out for with this...

The "started" setting (array for listing strings) in the "allowed_types_for_bubble_progress" config setting enables the following:

When a child content is started, the parent will also be started."

This is useful when you have a kind of content (like "course" for Drumeo) that should be marked as started when a child is started. However, if you have a kind of content that you don't want marked as started (say perhaps because it has it's own system with other consideration that are beyond the concern here), you don't want the parent started when the child is.

Keep in mind that children here can have multiple parents.

What we've done is offer the ability to specify which content **parent** types should be marked as started when their children are started. That is the "started" setting (array for listing strings) in the "allowed_types_for_bubble_progress" config setting. There is also a "completed" setting.

You can have a value in both list if it has no restrictions, or just one, or neither;

```php
'allowed_types_for_bubble_progress' => [
    'started' =>    [
        'foo','bar', 'baz' 
    ],
    'completed' =>  [ 
        'foo','bar', 'qux'
    ]
];
```

But note that this only applies for progress ***bubbling***. Look at `UserContentProgressService` method `bubbleProgress` and you will see the following:

Say you have a parent of a type for which *bubbling of **started** progress event is **not** allowed*.

If that parent is itself **not yet started**, it will not have progress record written or updated when one of it's children is. If it's in the "completed" allowed-types list, it can be marked as completed if all it's children are, but unless exactly that happens, it will not have it's progress_percent saved. That is *unless* it is already started of it's own accord. If the parent is already started, then when a child is updated, the progress_percent value of the parent will be edited as per any other content of a type allowed as per the allowed-for-started config settings.  