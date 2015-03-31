<?php

namespace Liip\ImagineBundle;

interface ImagineEvents
{
    const PRE_RESOLVE = 'liip_imagine.pre_resolve';

    const POST_RESOLVE = 'liip_imagine.post_resolve';

    const PRE_STORE = 'liip_imagine.pre_store';

    const PRE_IS_STORED = 'liip_imagine.pre_is_stored';

    const PRE_FIND = 'liip_imagine.pre_find';
}
