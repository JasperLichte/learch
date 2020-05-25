const func = ((path: string): Function|null => {
    switch (path) {
        case '/': return () => {};
    }
    return null;

// @ts-ignore
})(window.__PATH ?? '')?.();
