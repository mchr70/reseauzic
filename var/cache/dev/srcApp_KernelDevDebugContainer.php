<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerHlzgxvu\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerHlzgxvu/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerHlzgxvu.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerHlzgxvu\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerHlzgxvu\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'Hlzgxvu',
    'container.build_id' => 'bcb0118e',
    'container.build_time' => 1551104471,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerHlzgxvu');
