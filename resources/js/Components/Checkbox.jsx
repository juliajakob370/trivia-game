export default function Checkbox({ className = '', ...props }) {
    return (
        <input
            {...props}
            type="checkbox"
            className={
                'rounded border-rose text-plum-dark shadow-sm focus:ring-plum ' +
                className
            }
        />
    );
}
