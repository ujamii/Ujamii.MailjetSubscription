# Ujamii.MailjetSubscription

This package adds two new form finishers for the Neos Form Builder to subscribe and unsubscribe users to/from Mailjet mailing lists.

## Installation

The package can be installed via Composer:

```bash
composer require ujamii/neos-mailjetsubscription
```

## Requirements

* Neos CMS 8.x+
* t3n/mailjet-adapter

## Configuration

Add your Mailjet API credentials to your NEOS `Configuration/Settings.yaml`:

```yaml
# Settings.yaml
t3n:
    MailJetAdapter:
        mailjet:
            clientConfiguration:
                apiKey: 'your-api-key'
                apiSecret: 'your-api-secret'
```

## Features

This package provides:

1. **MailjetSubscribeFinisher**: Adds a contact to one or more Mailjet mailing list
2. **MailjetUnsubscribeFinisher**: Removes a contact from one or more Mailjet mailing list

## Usage

### Form Builder Integration

After installing the package, the new finishers will be available in the Form Builder in the Neos backend.

#### Subscribe Finisher Configuration

When adding the MailjetSubscribeFinisher to your form, you can configure:

- **List ID**: The Mailjet list ID(s) to subscribe the contact to

The Finisher expects 3 field ids to be in the form: `firstname`, `lastname` and `email`

#### Unsubscribe Finisher Configuration

When adding the MailjetUnsubscribeFinisher to your form, you can configure:

- **List ID**: The Mailjet list ID(s) to unsubscribe the contact from

The Finisher expects 1 field id to be in the form: `email`

## DataSource for List Selection

The package includes a DataSource for selecting Mailjet lists in the Neos backend. This allows editors to choose from available lists when configuring forms.

## License

This package is licensed under the [GPLv3 license](LICENSE).

## Contribution

Contributions are welcome! Please feel free to submit a Pull Request.
