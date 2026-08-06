export default function InputLabel({
    value,
    className = '',
    children,
    ...props
}) {
    return (
        <label
            {...props}
            className={
                `block text-sm font-medium text-plum-dark ` +
                className
            }
        >
            {value ? value : children}
        </label>
    );
}
