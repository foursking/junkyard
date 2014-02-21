
g google
@MyOutput
this is sentence 1.

g git :normal Ga111
g py :normal Ga111
g is a break.
g v2ex :normal Ga111

:%s/<p>\(\(\w\|\s\|\.\)\+\)<\/p>/\r@MyOutput\r\1\r/g
