function password(length) {
    const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
    const symbolChars = '.';

    let result = '';

    // Ensure at least one uppercase letter
    result += uppercaseChars.charAt(Math.floor(Math.random() * uppercaseChars.length));

    // Ensure at least one lowercase letter
    result += lowercaseChars.charAt(Math.floor(Math.random() * lowercaseChars.length));

    // Ensure at least one symbol
    result += symbolChars.charAt(Math.floor(Math.random() * symbolChars.length));

    // Generate the remaining characters
    for (let i = result.length; i < length; i++) {
        const allChars = uppercaseChars + lowercaseChars + symbolChars;
        result += allChars.charAt(Math.floor(Math.random() * allChars.length));
    }

    return result;
}